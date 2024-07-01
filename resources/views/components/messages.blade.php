@php
    $messages = [];
    if(Session::has('success'))
        $messages['success'] = Session::get('success');
    if(Session::has('error'))
        $messages['error'] = Session::get('error');
@endphp
<span class="hidden bg-green-400 bg-red-400 bg-green-500 bg-red-500"></span>
<div class="absolute top-0 right-0 w-96 max-w-full mt-2 px-2 flex flex-col">
    @if(count($messages))
        @foreach ($messages as $type => $message)
            <div class="w-full bg-{{ $type == 'success' ? 'green' : 'red' }}-400 text-white shadow-xl rounded mt-2 cursor-pointer transition-all duration-300 font-semibold" style="opacity: 0;" role="alert"
                x-data="{
                    time: 3000,
                    elapsed: 0,
                    dismiss() {
                        $el.style.opacity = 0; 
                        setTimeout(() => $el.remove(), 500);
                    }
                }"
                x-init="
                    $el.style.opacity = 1;
                    var dismissInterval = setInterval(() => {elapsed = elapsed+100;}, 100)
                    setTimeout(() => {dismiss(); clearInterval(dismissInterval);}, time)
                "
                @click="dismiss"
            >
                <div class="flex p-5">
                    <p>{!! $message !!}</p>
                </div>
                <div class="w-full bg-{{ $type == 'success' ? 'green' : 'red' }}-200 rounded-full h-1">
                    <div class="bg-{{ $type == 'success' ? 'green' : 'red' }}-500 h-1 rounded-full transition-all" :style="{width: elapsed/time*100+'%', maxWidth: '100%'}"></div>
                </div>
            </div>
        @endforeach
    @endif
</div>