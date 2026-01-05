<div class="notice d-flex bg-light text-danger border border-danger border-dashed rounded p-6 mb-5">
    <i class="ki-duotone ki-information fs-2tx text-danger me-4">
        <span class="path1"></span>
        <span class="path2"></span>
        <span class="path3"></span>
    </i>
    <div class="d-flex flex-stack flex-grow-1">
        <div class="fw-semibold">
            <h4 class="text-gray-900 fw-bold">{{ $title }}</h4>
            <div class="fs-6 text-gray-700">
                {{ $message }}
                @if ($linkUrl && $linkText)
                    <a class="fw-bold text-danger" href="{{ $linkUrl }}">{{ $linkText }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
