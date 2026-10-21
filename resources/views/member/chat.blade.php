@extends('layouts.app')

@section('title', 'Chat Admin')

@section('content')
<section class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white border rounded-2xl shadow-sm flex flex-col h-[75vh]">

        <div class="px-5 py-4 border-b flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-yellow-400 flex items-center justify-center font-bold">A</div>
            <div>
                <p class="font-semibold">Admin {{ config('app.name') }}</p>
                <p class="text-xs text-green-600">Online</p>
            </div>
        </div>

        <div id="chat-box" class="flex-1 overflow-y-auto p-5 space-y-3 bg-gray-50">
            @foreach ($pesan as $p)
                @php $saya = $p['dari'] === 'member'; @endphp
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
            <input id="chat-input" type="text" placeholder="Tulis pesan..." autocomplete="off"
                   class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <button class="bg-yellow-400 font-semibold px-5 rounded-full hover:bg-yellow-300">Kirim</button>
        </form>
    </div>
</section>

<script>
    const box = document.getElementById('chat-box');
    box.scrollTop = box.scrollHeight;

    // Simulasi kirim pesan (belum tersimpan ke database)
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