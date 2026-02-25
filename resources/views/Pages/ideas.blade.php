<x-nav title="Dashboard">

    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tighter">
                Your Ideas
            </h1>
            <p class="text-gray-500 mt-2 text-lg">Managing your creative pipeline.</p>
        </div>
        
        <button class="flex items-center gap-2 px-6 py-3 bg-white text-black rounded-xl font-bold hover:bg-gray-200 transition active:scale-95 shadow-[0_0_20px_rgba(255,255,255,0.1)]">
            <span>+</span>
            New Idea
        </button>
    </div>

    @if($ideas->isEmpty())
        <div class="relative group overflow-hidden text-center py-32 border border-white/5 rounded-[2rem] bg-gradient-to-b from-white/[0.03] to-transparent">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white/[0.05] via-transparent to-transparent opacity-50"></div>
            <div class="relative z-10">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 border border-white/10">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No ideas yet</h3>
                <p class="text-gray-500 max-w-xs mx-auto">The best way to predict the future is to invent it. Start by creating your first idea.</p>
            </div>
        </div>
    @else

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($ideas as $idea)
                @php
                    $statusColors = [
                        'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                        'in progress' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',
                        'completed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                    ];

                    $status = strtolower($idea->status->value ?? $idea->status);
                    $badgeClass = $statusColors[$status] ?? 'bg-gray-500/10 text-gray-400 border-gray-500/20';
                @endphp

                <div class="group relative flex flex-col h-full rounded-[2rem] border border-white/[0.08] bg-[#0A0A0A] p-8 transition-all duration-500 hover:border-white/30 hover:shadow-[0_20px_50px_rgba(0,0,0,0.7)]">
                    
                    <div class="absolute inset-0 rounded-[2rem] bg-gradient-to-br from-white/[0.03] to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative z-10 flex flex-col h-full">
                        
                        <div class="flex justify-between items-start mb-6">
                            <span class="text-[10px] px-3 py-1 rounded-full border font-bold uppercase tracking-[0.15em] {{ $badgeClass }}">
                                {{ $idea->status->value ?? $idea->status }}
                            </span>
                            <div class="text-gray-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/></svg>
                            </div>
                        </div>

                        <div class="flex-1 text-left">
                            <h2 class="text-xl font-bold text-white leading-tight mb-3 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-white group-hover:to-gray-400 transition-all duration-300">
                                {{ $idea->title }}
                            </h2>
                            <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 group-hover:text-gray-300 transition-colors">
                                {{ $idea->description }}
                            </p>
                        </div>
                        
                        <div class="mt-8 pt-6 border-t border-white/[0.05] flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-white/20 group-hover:bg-white transition-colors"></div>
                                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $idea->created_at?->diffForHumans() ?? 'Just now' }}
                                </span>
                            </div>

                            <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 -translate-x-2 group-hover:translate-x-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

    @endif

</x-nav>