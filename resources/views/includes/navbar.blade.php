<nav class="fixed top-[6px] left-0 w-full bg-white flex justify-between items-center px-[5%] h-[70px] shadow-[0_4px_12px_rgba(42,157,143,0.12)] border-b-2 border-smanda-red z-[2000]">
    <a href="{{ url('/') }}" class="flex items-center gap-[12px] ml-[-15px] text-[1.25rem] font-bold text-smanda-black-dark no-underline">
        <!-- Gambar Logo -->
        <img src="{{ asset('images/logo_smandu.png') }}" alt="Logo SMAN 2 Medan" class="w-[48px] h-[48px] object-contain">
    </a>
        

    <!-- <span class="no-underline text-smanda-black-dark font-semibold text-[0.95rem] px-[15px] h-full flex items-center transition-all duration-300 hover:text-smanda-black hover:bg-smanda-black-light">SMAN 2 Medan</span> -->
    <ul class="flex list-none h-full m-0 p-0">
        <li class="relative flex items-center h-full">
            <a href="{{ url('/') }}" class="no-underline text-smanda-black-dark font-semibold text-[0.95rem] px-[20px] h-full flex items-center transition-all duration-300 hover:text-smanda-black hover:bg-smanda-black-light">Beranda</a>
        </li>

        <!-- Profil -->
        <li class="relative flex items-center h-full group">
            <a href="#" class="no-underline text-smanda-black-dark font-semibold text-[0.95rem] px-[20px] h-full flex items-center transition-all duration-300 group-hover:text-smanda-black group-hover:bg-smanda-black-light">Profil ▾</a>
            <ul class="absolute top-full left-0 bg-white shadow-[0_8px_20px_rgba(0,0,0,0.1)] rounded-b-[8px] min-w-[200px] opacity-0 invisible translate-y-[10px] transition-all duration-300 ease-in-out list-none border-t-[4px] border-smanda-black overflow-hidden m-0 p-0 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0">
                <li><a href="{{ url('/profil/tentang') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Tentang Sekolah</a></li>
                <li><a href="{{ url('/profil/kepala-sekolah') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Kepala Sekolah</a></li>
                <li><a href="{{ url('/profil/sarpras') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Sarana & Prasarana</a></li>
                <li><a href="{{ url('/profil/sarpras') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Organisasi</a></li>
            </ul>
        </li>

        <!-- Akademik -->
        <li class="relative flex items-center h-full group">
            <a href="#" class="no-underline text-smanda-black-dark font-semibold text-[0.95rem] px-[20px] h-full flex items-center transition-all duration-300 group-hover:text-smanda-black group-hover:bg-smanda-black-light">Akademik ▾</a>
            <ul class="absolute top-full left-0 bg-white shadow-[0_8px_20px_rgba(0,0,0,0.1)] rounded-b-[8px] min-w-[200px] opacity-0 invisible translate-y-[10px] transition-all duration-300 ease-in-out list-none border-t-[4px] border-smanda-black overflow-hidden m-0 p-0 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0">
                <li><a href="{{ url('/akademik/silabus') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Silabus</a></li>
                <li><a href="{{ url('/akademik/kalender') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Kalender</a></li>
                <li><a href="{{ url('/akademik/prestasi') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Prestasi</a></li>
            </ul>
        </li>

        <!-- Informasi -->
        <li class="relative flex items-center h-full group">
            <a href="#" class="no-underline text-smanda-black-dark font-semibold text-[0.95rem] px-[20px] h-full flex items-center transition-all duration-300 group-hover:text-smanda-black group-hover:bg-smanda-black-light">Informasi ▾</a>
            <ul class="absolute top-full left-0 bg-white shadow-[0_8px_20px_rgba(0,0,0,0.1)] rounded-b-[8px] min-w-[200px] opacity-0 invisible translate-y-[10px] transition-all duration-300 ease-in-out list-none border-t-[4px] border-smanda-black overflow-hidden m-0 p-0 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0">
                <li><a href="{{ url('/akademik/artikel') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Artikel</a></li>
                <li><a href="{{ url('/akademik/berita') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Berita</a></li>
            </ul>
        </li>

        <!-- Direktori -->
        <li class="relative flex items-center h-full group">
            <a href="#" class="no-underline text-smanda-black-dark font-semibold text-[0.95rem] px-[20px] h-full flex items-center transition-all duration-300 group-hover:text-smanda-black group-hover:bg-smanda-black-light">Direktori ▾</a>
            <ul class="absolute top-full left-0 bg-white shadow-[0_8px_20px_rgba(0,0,0,0.1)] rounded-b-[8px] min-w-[200px] opacity-0 invisible translate-y-[10px] transition-all duration-300 ease-in-out list-none border-t-[4px] border-smanda-black overflow-hidden m-0 p-0 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0">
                <li><a href="{{ url('/direktori/siswa') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Siswa</a></li>
                <li><a href="{{ url('/direktori/guru') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Guru</a></li>
                <li><a href="{{ url('/direktori/alumni') }}" class="block py-[10px] px-[20px] text-[#333] no-underline text-[0.9rem] transition-all duration-200 hover:bg-smanda-black-light hover:text-smanda-black-dark hover:pl-[25px]">Alumni</a></li>
            </ul>
        </li>

        <li class="relative flex items-center h-full"><a href="{{ url('/ppdb') }}" class="no-underline text-smanda-black-dark font-semibold text-[0.95rem] px-[20px] h-full flex items-center transition-all duration-300 hover:text-smanda-black hover:bg-smanda-black-light">PPDB</a></li>
        <li class="relative flex items-center h-full"><a href="{{ url('/kelulusan') }}" class="no-underline text-smanda-black-dark font-semibold text-[0.95rem] px-[20px] h-full flex items-center transition-all duration-300 hover:text-smanda-black hover:bg-smanda-black-light">Kelulusan</a></li>
        <li class="relative flex items-center h-full"><a href="{{ url('/kontak') }}" class="no-underline text-smanda-black-dark font-semibold text-[0.95rem] px-[20px] h-full flex items-center transition-all duration-300 hover:text-smanda-black hover:bg-smanda-black-light">Kontak</a></li>
        
        <li class="relative flex items-center h-full -mr-[25px]">
            <a href="{{ url('/login') }}" class="bg-smanda-green text-smanda-black-dark py-[8px] px-[20px] ml-[30px] rounded-[20px] h-auto font-bold self-center border border-smanda-yellow-hover transition-all duration-300 ease-in-out hover:bg-smanda-black hover:text-white hover:border-smanda-black-dark">Login</a>
        </li>
    </ul>
</nav>