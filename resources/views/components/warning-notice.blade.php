<!--begin::Notice-->
<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mb-5"
     @if ($style) style="{{ $style }}" @endif>
    
    <div class="d-flex align-items-center me-4">
        <i class="ki-duotone ki-information fs-2tx text-warning">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
    </div>

    <div class="d-flex flex-stack flex-grow-1">
        <div class="fw-semibold text-start">
            <h4 class="text-gray-900 fw-bold">{{ $title }}</h4>
            <div class="fs-6 text-gray-700">
                {{ $message }}
                @if (!empty($linkUrl) && !empty($linkText))
                    <a class="fw-bold" href="{{ $linkUrl }}">{{ $linkText }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
<!--end::Notice-->
