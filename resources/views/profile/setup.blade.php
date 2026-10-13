<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Registration - SSO Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-slate-100 to-blue-100 h-screen flex flex-col overflow-hidden font-sans text-slate-800">

    <!-- Scrollable Main Container -->
    <main class="flex-grow overflow-y-auto w-full p-4 sm:p-6">
        <div class="max-w-3xl mx-auto my-6">
            <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10 border border-slate-100">
                
                <!-- Header with Logo & Brand -->
                <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-100">
                    <div class="p-1">
                        <img src="{{ asset('images/hsel-logo.png') }}" alt="Hospital Selayang Logo" class="h-12 w-auto">
                    </div>
                    <div class="border-l border-slate-300 pl-4">
                        <h1 class="text-xl font-black text-slate-900 tracking-tight uppercase">SSO PORTAL</h1>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">HOSPITAL SELAYANG</p>
                    </div>
                </div>

                <!-- Section Title -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">User Profile Registration</h2>
                    <p class="text-sm text-slate-500 mt-1">Please complete or update your personal and service details.</p>
                </div>

                <!-- Validation Error Alert -->
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                        <p class="text-sm font-bold text-red-800 mb-1">Please fix the following errors:</p>
                        <ul class="list-disc list-inside text-xs text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.setup.store') }}" class="space-y-8">
                    @csrf
                    
                    <!-- SECTION 1: PERSONAL DETAILS -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-1.5 h-5 bg-blue-700 rounded-full"></span>
                            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Personal Details</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Officer Name (Read-Only) -->
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Officer Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" readonly 
                                    class="w-full rounded-lg bg-slate-100 border border-slate-200 text-slate-500 p-3 text-sm focus:outline-none cursor-not-allowed uppercase font-semibold">
                            </div>

                            <!-- NRIC Number -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">
                                    NRIC No. <span class="text-red-500 font-normal lowercase">(e.g., 780728035465)</span>
                                </label>
                                <input type="text" name="no_kp" value="{{ old('no_kp', $user->no_kp) }}" placeholder="780728035465" required 
                                       class="w-full rounded-lg bg-blue-50/50 border border-blue-100 text-slate-800 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Official Department Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                                       class="w-full rounded-lg bg-blue-50/50 border border-blue-100 text-slate-800 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                            </div>

                            <!-- Gender -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Gender</label>
                                <select name="jantina" required class="w-full rounded-lg bg-blue-50/50 border border-blue-100 text-slate-800 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                                    <option value="">Please Select</option>
                                    <option value="Lelaki" {{ old('jantina', $user->jantina) == 'Lelaki' ? 'selected' : '' }}>Male</option>
                                    <option value="Perempuan" {{ old('jantina', $user->jantina) == 'Perempuan' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <!-- Ethnicity -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Ethnicity</label>
                                <select name="bangsa" required class="w-full rounded-lg bg-blue-50/50 border border-blue-100 text-slate-800 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                                    <option value="">Please Select</option>
                                    <option value="Melayu" {{ old('bangsa', $user->bangsa) == 'Melayu' ? 'selected' : '' }}>Malay</option>
                                    <option value="Cina" {{ old('bangsa', $user->bangsa) == 'Cina' ? 'selected' : '' }}>Chinese</option>
                                    <option value="India" {{ old('bangsa', $user->bangsa) == 'India' ? 'selected' : '' }}>Indian</option>
                                    <option value="Lain-lain" {{ old('bangsa', $user->bangsa) == 'Lain-lain' ? 'selected' : '' }}>Others</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: SERVICE DETAILS -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-1.5 h-5 bg-blue-700 rounded-full"></span>
                            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Service Details</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Position -->
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Position</label>
                                <select name="job_description" required class="w-full rounded-lg bg-blue-50/50 border border-blue-100 text-slate-800 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                                    <option value="">Please Select</option>
                                    <option value="Pegawai Teknologi Maklumat" {{ old('job_description', $user->job_description ?? ($suggestedRole == 'ITD' ? 'Pegawai Teknologi Maklumat' : '')) == 'Pegawai Teknologi Maklumat' ? 'selected' : '' }}>Information Technology Officer</option>
                                    <option value="Pegawai Perubatan" {{ old('job_description', $user->job_description) == 'Pegawai Perubatan' ? 'selected' : '' }}>Medical Officer</option>
                                    <option value="Jururawat" {{ old('job_description', $user->job_description) == 'Jururawat' ? 'selected' : '' }}>Nurse</option>
                                    <option value="Pegawai Farmasi" {{ old('job_description', $user->job_description) == 'Pegawai Farmasi' ? 'selected' : '' }}>Pharmacy Officer</option>
                                </select>
                            </div>

                            <!-- Grade -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Grade</label>
                                <select name="gred" required class="w-full rounded-lg bg-blue-50/50 border border-blue-100 text-slate-800 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                                    <option value="">Please Select</option>
                                    <option value="F41" {{ old('gred', $user->gred) == 'F41' ? 'selected' : '' }}>F41</option>
                                    <option value="UD41" {{ old('gred', $user->gred) == 'UD41' ? 'selected' : '' }}>UD41</option>
                                    <option value="UF41" {{ old('gred', $user->gred) == 'UF41' ? 'selected' : '' }}>UF41</option>
                                    <option value="U29" {{ old('gred', $user->gred) == 'U29' ? 'selected' : '' }}>U29</option>
                                </select>
                            </div>

                            <!-- Group -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Group</label>
                                <select name="kumpulan" required class="w-full rounded-lg bg-blue-50/50 border border-blue-100 text-slate-800 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                                    <option value="">Please Select</option>
                                    <option value="Pengurusan Tertinggi" {{ old('kumpulan', $user->kumpulan) == 'Pengurusan Tertinggi' ? 'selected' : '' }}>Top Management</option>
                                    <option value="Pengurusan dan Profesional" {{ old('kumpulan', $user->kumpulan) == 'Pengurusan dan Profesional' ? 'selected' : '' }}>Management and Professional</option>
                                    <option value="Pelaksana" {{ old('kumpulan', $user->kumpulan) == 'Pelaksana' ? 'selected' : '' }}>Support Staff (Pelaksana)</option>
                                </select>
                            </div>

                            <!-- Department -->
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Department / Unit</label>
                                <select name="jabatan" required class="w-full rounded-lg bg-blue-50/50 border border-blue-100 text-slate-800 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                                    <option value="">Please Select</option>
                                    <option value="Jabatan Teknologi Maklumat" {{ old('jabatan', $user->jabatan) == 'Jabatan Teknologi Maklumat' ? 'selected' : '' }}>Information Technology Department</option>
                                    <option value="Jabatan Farmasi" {{ old('jabatan', $user->jabatan) == 'Jabatan Farmasi' ? 'selected' : '' }}>Pharmacy Department</option>
                                    <option value="Jabatan Kecemasan" {{ old('jabatan', $user->jabatan) == 'Jabatan Kecemasan' ? 'selected' : '' }}>Emergency Department</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full bg-[rgb(28,63,170)] hover:bg-blue-800 text-white font-bold py-3.5 px-4 rounded-xl shadow-md transition-all text-sm tracking-wide">
                            Save & Continue to Dashboard
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <!-- Fixed Bottom Footer -->
    <footer class="bg-white border-t border-slate-200 py-4 shrink-0 relative z-20">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs font-semibold text-slate-500">
            © {{ date('Y') }} Hospital Selayang. Developed by Muhammad Haziq Zikri (ITD HSEL)
        </div>
    </footer>

</body>
</html>