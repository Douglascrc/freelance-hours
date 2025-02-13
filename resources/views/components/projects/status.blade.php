@props(['status'])

<span
{{ $attributes->class([
    'rounded-full font-bold text-center uppercase py-[6px] px-[14px] text-[12px] tracking-wide',
    'bg-[#C0F7B4] text-[#1D8338]' => $status == \App\ProjectStatus::Open,
    'bg-[#F7B4B4] text-[#83381D]' => $status == \App\ProjectStatus::Closed
]) }}
>
  {{ $status->label() }}
</span>