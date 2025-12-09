<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pic;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;

class PicController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();
        $isStudentOrganization = auth()->user()->student_organization;
        $isStudentActivityUnit = auth()->user()->student_activity_unit;

        $pics = Pic::with(['event'])
            ->whereHas('event', function ($query) use ($user, $isStudentOrganization, $isStudentActivityUnit) {
                $query->where(function ($q) use ($user, $isStudentOrganization, $isStudentActivityUnit) {
                    $q->when($isStudentOrganization, function ($query) use ($isStudentOrganization) {
                        $query->where('student_organizations_id', $isStudentOrganization->id);
                    })
                    ->when($isStudentActivityUnit, function ($query) use ($isStudentActivityUnit) {
                        $query->where('student_activity_units_id', $isStudentActivityUnit->id);
                    });
                });
            })
            ->when($search, function ($query, $search) {
                $query->whereHas('event', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('dashboard.pic.index', [
            'page' => 'Halaman PIC',
            'pics' => $pics,
            'search' => $search,
        ]);
        }

    public function show(Pic $pic)
    {
        $pic->load([
            'event'
        ]);

        return view('dashboard.pic.detail', [
            'page' => 'Halaman Detail PIC',
            'pic' => $pic,
            'events' => $this->getUserEvents(),
        ]);
    }

    public function create()
    {
        return view('dashboard.pic.create', [
            'page' => 'Halaman Tambah PIC',
            'events' => $this->getUserEvents(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'username' => 'required',
                'password' => 'required',
                'events_id' => 'required',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);
            $pic = Pic::create($validatedData);

            return redirect()->route('pic.index')->with('success', 'Berhasil menambahkan pic baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan pic baru!');
        }
    }

    public function edit(Pic $pic)
    {
        $pic->load('event');

        return view('dashboard.pic.edit', [
            'page' => 'Halaman Edit PIC',
            'pic' => $pic,
            'events' => $this->getUserEvents(),
        ]);
    }

    public function update(Request $request, Pic $pic)
    {
        try {
            $pic->load(['event']);
            $validatedData = $request->validate([
                'username' => 'required',
                'password' => 'nullable',
                'events_id' => 'required',
            ]);

            if (!empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }   
            $pic->update($validatedData);

            return redirect()->route('pic.index')->with('success', 'Berhasil mengedit pic!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit pic!');
        }
    }

    public function destroy(Pic $pic)
    {
        try {
            $pic->delete();
            return redirect()->route('pic.index')->with('success', 'Berhasil menghapus pic!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus pic!');
        }
    }

    private function getUserEvents()
    {
        $user = auth()->user();
        $isStudentOrganization = $user->student_organization;
        $isStudentActivityUnit = $user->student_activity_unit;

        return Event::where(function ($query) use ($isStudentOrganization, $isStudentActivityUnit) {
            $query->when($isStudentOrganization, function ($q) use ($isStudentOrganization) {
                $q->where('student_organizations_id', $isStudentOrganization->id);
            })
            ->when($isStudentActivityUnit, function ($q) use ($isStudentActivityUnit) {
                $q->where('student_activity_units_id', $isStudentActivityUnit->id);
            });
        })->get();
    }

    public function check(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username'  => 'required',
                'password'  => 'required',
                'events_id' => 'required',
                'link'      => 'required',
                'events_id'  => 'required',
            ]);
            
            $pic = Pic::where('username', $credentials['username'])
            ->where('events_id', $credentials['events_id'])
            ->first();
            
            if (!$pic) {
                return back()->with('failed', 'Akun PIC tidak ditemukan!');
            }

            if (!Hash::check($credentials['password'], $pic->password)) {
                return back()->with('failed', 'Password PIC salah!');
            }

            // Jika aksinya adalah delete
            if ($credentials['link'] === 'event.destroy') {
                Event::findOrFail($credentials['events_id'])->delete();
                return redirect()->route('event.index')->with('success', 'Event berhasil dihapus!');
            }

            // Jika hanya redirect (show / edit)
            return redirect()->route($credentials['link'], $credentials['events_id']);

        } catch (\Exception $e) {
            logger($e->getMessage());
            return back()->with('failed', 'Terjadi kesalahan sistem!');
        }
    }
}
