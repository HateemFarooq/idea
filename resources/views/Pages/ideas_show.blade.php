<x-nav title="Idea">

    {{-- ✅ FLASH MESSAGE --}}
    @if(session('success'))
        <div class="mb-8 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 animate-in fade-in slide-in-from-top-4 duration-300">
            <div class="flex items-center gap-3">
                <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- ================= ACTION BAR ================= --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">

        <a href="{{ route('ideas') }}"
           class="group inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-white transition-all">
            <span class="transition-transform group-hover:-translate-x-1">←</span>
            Back to Ideas
        </a>

        <div class="flex items-center gap-3">
            {{-- EDIT --}}
            <button class="px-6 py-2.5 rounded-xl border border-white/5 bg-white/5 text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all active:scale-95">
                Edit Idea
            </button>

            {{-- DELETE BUTTON --}}
            <button
                onclick="openDeleteModal()"
                class="px-6 py-2.5 rounded-xl bg-red-500/10 border border-red-500/20 text-sm font-semibold text-red-400 hover:bg-red-500/20 hover:border-red-500/40 transition-all active:scale-95">
                Delete
            </button>
        </div>
    </div>

    {{-- ================= IDEA CARD ================= --}}
    <div class="max-w-4xl">

        @php
            $statusColors = [
                'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                'in progress' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',
                'completed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
            ];

            $status = strtolower($idea->status->value ?? $idea->status);
            $badgeClass = $statusColors[$status] ?? 'bg-gray-500/10 text-gray-400 border-gray-500/20';
        @endphp

        {{-- Main Container with subtle outer glow --}}
        <div class="relative group">
            <div class="absolute -inset-px bg-gradient-to-b from-white/10 to-transparent rounded-[2.5rem] pointer-events-none"></div>
            
            <div class="relative rounded-[2.5rem] border border-white/10 bg-[#0D0D0D] p-8 md:p-12 shadow-2xl overflow-hidden">
                
                {{-- Decorative background element --}}
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-64 h-64 bg-white/5 rounded-full blur-[80px] pointer-events-none"></div>

                {{-- Status Badge --}}
                <span class="inline-flex items-center gap-1.5 text-[11px] px-4 py-1.5 rounded-full border font-bold uppercase tracking-wider {{ $badgeClass }}">
                    <span class="h-1.5 w-1.5 rounded-full bg-current opacity-70"></span>
                    {{ $idea->status->value ?? $idea->status }}
                </span>

                <h1 class="mt-8 text-4xl md:text-5xl font-black text-white leading-[1.1] tracking-tight">
                    {{ $idea->title }}
                </h1>

                <div class="mt-8 space-y-6">
                    <p class="text-lg text-gray-400 leading-relaxed font-light">
                        {{ $idea->description }}
                    </p>
                </div>

                <div class="mt-12 pt-8 border-t border-white/5 flex flex-wrap items-center gap-6 text-xs font-medium uppercase tracking-widest text-gray-500">
                    <div class="flex items-center gap-2">
                        <span class="text-white/20">Posted</span>
                        <span class="text-gray-400">{{ $idea->created_at?->diffForHumans() }}</span>
                    </div>
                    <div class="h-1 w-1 rounded-full bg-white/20"></div>
                    <div class="flex items-center gap-2">
                        <span class="text-white/20">Reference</span>
                        <span class="text-gray-400">#{{ str_pad($idea->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ================= DELETE MODAL ================= --}}
    <div id="deleteModal"
         class="fixed inset-0 z-50 hidden items-center justify-center p-4">

        {{-- Backdrop with heavier blur --}}
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md transition-opacity"
             onclick="closeDeleteModal()"></div>

        {{-- Modal Content --}}
        <div class="relative w-full max-w-md transform rounded-[2rem] border border-white/10 bg-[#121212] p-8 shadow-[0_0_50px_-12px_rgba(0,0,0,0.5)] transition-all">
            
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-red-500/10 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </div>

            <h3 class="text-2xl font-bold text-white mb-2">Confirm Delete</h3>
            <p class="text-gray-400 leading-relaxed mb-8">
                Are you sure? This will permanently remove <span class="text-white font-medium">"{{ $idea->title }}"</span>. This action is irreversible.
            </p>

            <div class="flex flex-col sm:flex-row justify-end gap-3">
                <button
                    onclick="closeDeleteModal()"
                    class="order-2 sm:order-1 px-6 py-3 rounded-xl border border-white/5 text-sm font-bold text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                    Cancel
                </button>

                <form method="POST" action="{{ route('ideas.destroy', $idea) }}" class="order-1 sm:order-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-6 py-3 rounded-xl bg-red-600 text-white text-sm font-bold hover:bg-red-500 shadow-lg shadow-red-900/20 transition-all active:scale-95">
                        Confirm Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= MODAL SCRIPT ================= --}}
    <script>
        function openDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Prevent scroll
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto'; // Re-enable scroll
        }
    </script>

</x-nav>