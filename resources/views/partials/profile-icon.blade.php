@switch($type)
    @case('origin')
        <svg viewBox="0 0 48 48" fill="none"><circle cx="22" cy="22" r="10" stroke="currentColor" stroke-width="2"/><path d="M32 32 42 42" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M18 20h8M22 16v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        @break
    @case('control')
        <svg viewBox="0 0 48 48" fill="none"><rect x="12" y="8" width="24" height="32" rx="2" stroke="currentColor" stroke-width="2"/><path d="M18 18h12M18 24h12M18 30h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M30 28l3 3 6-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break
    @case('cert')
        <svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="20" r="12" stroke="currentColor" stroke-width="2"/><path d="M18 32 24 44l6-12" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><circle cx="24" cy="20" r="5" stroke="currentColor" stroke-width="1.8"/></svg>
        @break
    @case('trust')
        <svg viewBox="0 0 48 48" fill="none"><path d="M24 8c-6 4-14 5-14 14 0 10 6 16 14 22 8-6 14-12 14-22C38 13 30 12 24 8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M17 24c2 2 5 3 7 3s5-1 7-3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        @break
    @case('shield')
        <svg viewBox="0 0 48 48" fill="none"><path d="M24 6 10 12v10c0 10 6 16 14 20 8-4 14-10 14-20V12L24 6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M18 24l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break
    @case('category')
    @default
        <svg viewBox="0 0 48 48" fill="none"><rect x="10" y="14" width="28" height="22" rx="2" stroke="currentColor" stroke-width="2"/><path d="M18 22h12M18 28h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M24 10v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
@endswitch
