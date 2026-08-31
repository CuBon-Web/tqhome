@switch($type)
    @case('building')
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="10" y="14" width="28" height="28" rx="2" stroke="currentColor" stroke-width="2"/><path d="M18 24h4M26 24h4M18 30h4M26 30h4M18 36h4M26 36h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M24 8 12 14v2h24v-2L24 8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
        @break
    @case('people')
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="18" cy="18" r="5" stroke="currentColor" stroke-width="2"/><circle cx="32" cy="20" r="4" stroke="currentColor" stroke-width="2"/><path d="M8 38c0-5.5 4.5-10 10-10s10 4.5 10 10M24 38c0-4 3-7.5 8-7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        @break
    @case('box')
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 16 24 8l16 8v20l-16 8-16-8V16Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M24 36V24M8 16l16 8 16-8" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
        @break
    @case('truck')
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 14h20v16H8V14Z" stroke="currentColor" stroke-width="2"/><path d="M28 20h8l4 6v4H28V20Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><circle cx="14" cy="34" r="3" stroke="currentColor" stroke-width="2"/><circle cx="34" cy="34" r="3" stroke="currentColor" stroke-width="2"/></svg>
        @break
    @case('factory')
        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 17V8l4 2V8l4 2V6l6 3v8H3Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/><path d="M7 17v-4M11 17v-4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
        @break
    @case('area')
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="6" width="16" height="14" rx="1.5" stroke="currentColor" stroke-width="1.6"/><path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        @break
    @case('process')
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="8" cy="8" r="3" stroke="currentColor" stroke-width="1.6"/><circle cx="16" cy="16" r="3" stroke="currentColor" stroke-width="1.6"/><path d="M10.5 10.5 13.5 13.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        @break
    @case('warehouse')
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 10 12 5l8 5v9H4v-9Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M9 19v-5h6v5" stroke="currentColor" stroke-width="1.6"/></svg>
        @break
    @case('cold')
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3v18M8.5 6.5 12 3l3.5 3.5M8.5 17.5 12 21l3.5-3.5M3 12h18M6.5 8.5 3 12l3.5 3.5M17.5 8.5 21 12l-3.5 3.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        @break
    @case('pack')
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 8 12 4l7 4v10l-7 4-7-4V8Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M12 14V22M5 8l7 4 7-4" stroke="currentColor" stroke-width="1.6"/></svg>
        @break
    @case('shield')
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24 6 8 12v10c0 10 6.5 16.5 16 20 9.5-3.5 16-10 16-20V12L24 6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M18 24l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break
    @case('quality')
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="24" cy="26" r="14" stroke="currentColor" stroke-width="2"/><path d="M24 12V8l4 2-4 2-4-2 4-2v4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M24 20v8l5 3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        @break
    @case('trust')
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 22c0-6 5.5-10 14-12 8.5 2 14 6 14 12v8l-14 8-14-8v-8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M16 24c2 2 5 3 8 3s6-1 8-3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        @break
    @case('care')
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24 34s-10-6.5-10-14a6 6 0 0 1 10-4 6 6 0 0 1 10 4c0 7.5-10 14-10 14Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M18 38h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        @break
    @case('growth')
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24 10a14 14 0 0 1 14 14c0 7.5-6 13.5-14 18-8-4.5-14-10.5-14-18A14 14 0 0 1 24 10Z" stroke="currentColor" stroke-width="2"/><path d="M24 18v8M20 22h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        @break
@endswitch
