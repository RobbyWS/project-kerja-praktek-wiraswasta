@extends('layouts.admin')

@section('title', 'Chat')

@section('content')
<div class="bg-white rounded-xl shadow-sm grid md:grid-cols-3 h-[calc(100vh-9rem)] overflow-hidden">

    {{-- Daftar percakapan --}}
    <aside class="border-r flex flex-col">
        <div class="p-4 border-b">
            <input type="text" placeholder="Cari member..."
                   class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div class="flex-1 overflow-y-auto divide-y">
            @foreach ($percakapan as $c)
                <a href="{{ route('admin.chat', ['user' => $c['id']]) }}"
                   class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 {{ $aktif['id'] === $c['id'] ? 'bg-yellow-50 border-l-4 border-yellow-400' : '' }}">
                    <div class="w-10 h-10 rounded-full bg-gray-800 text-white flex items-center justify-center font-bold flex-shrink-0">
                        {{ strtoupper(substr($c['nama'], 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between">
                            <p class="font-semibold text-sm truncate">{{ $c['nama'] }}</p>
                            <span class="text-[10px] text-gray-400">{{ $c['waktu'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-xs text-gray-500 truncate">{{ $c['terakhir'] }}</p>
                            @if ($c['belum_dibaca'] > 0)
                                <span class="ml-2 bg-yellow-400 text-gray-900 text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center">
                                    {{ $c['belum_dibaca'] }}
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </aside>

    {{-- Isi percakapan --}}
    <section class="md:col-span-2 flex flex-col">
        <div class="px-5 py-4 border-b flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gray-800 text-white flex items-center justify-center font-bold">
                {{ strtoupper(substr($aktif['nama'], 0, 1)) }}
            </div>
            <p class="font-semibold">{{ $aktif['nama'] }}</p>
        </div>

        <div id="chat-box" class="flex-1 overflow-y-auto p-5 space-y-3 bg-gray-50">
            @foreach ($pesan as $p)
                @php $saya = $p['dari'] === 'admin'; @endphp
                <div class="flex {{ $saya ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[75%] px-4 py-2 rounded-2xl text-sm
                        {{ $saya ? 'bg-yellow-400 text-gray-900 rounded-br-sm' : 'bg-white border rounded-bl-sm' }}">
                        <p>{{ $p['isi'] }}</p>
                        <p class="text-[10px] mt-1 text-right {{ $saya ? 'text-gray-700' : 'text-gray-400' }}">{{ $p['waktu'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <form id="chat-form" class="p-4 border-t flex gap-2">
            <input id="chat-input" type="text" placeholder="Balas pesan..." autocomplete="off"
                   class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <button class="bg-yellow-400 font-semibold px-5 rounded-full hover:bg-yellow-300">Kirim</button>
        </form>
    </section>
</div>

<script>
    const box = document.getElementById('chat-box');
    box.scrollTop = box.scrollHeight;

    document.getElementById('chat-form').addEventListener('submit', e => {
        e.preventDefault();
        const input = document.getElementById('chat-input');
        const teks  = input.value.trim();
        if (!teks) return;

        const wrap   = document.createElement('div');
        const bubble = document.createElement('div');
        wrap.className   = 'flex justify-end';
        bubble.className = 'max-w-[75%] px-4 py-2 rounded-2xl rounded-br-sm text-sm bg-yellow-400 text-gray-900';
        bubble.innerHTML = '<p></p><p class="text-[10px] mt-1 text-right text-gray-700"></p>';
        bubble.children[0].textContent = teks;
        bubble.children[1].textContent = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

        wrap.appendChild(bubble);
        box.appendChild(wrap);
        input.value = '';
        box.scrollTop = box.scrollHeight;
    });
</script>
@endsection