<div id="kt_app_toolbar_container" class="app-container d-flex flex-stack">
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

        <!-- Title with Icon -->
        <h1 class="page-heading d-flex text-dark fw-bold fs-2 mb-2 align-items-center">
            {{ $breadcrumb['page_header'] }}
        </h1>

        <!-- Breadcrumb -->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!-- First Item -->
            <li class="breadcrumb-item d-flex align-items-center text-muted">
                @if (!empty($breadcrumb['first_item_icon']))
                    <i class="fa-solid {{ $breadcrumb['first_item_icon'] }} me-1 text-muted"></i>
                @endif
                <a href="{{ $breadcrumb['first_item_link'] }}" class="text-muted text-hover-primary">
                    {{ $breadcrumb['first_item_name'] }}
                </a>
            </li>

            <!-- Separator -->
            <li class="breadcrumb-item mx-2">
                <span class="bullet bg-secondary w-5px h-2px"></span>
            </li>

            <!-- Second Item -->
            <li class="breadcrumb-item d-flex align-items-center text-muted">
                @if (!empty($breadcrumb['second_item_icon']))
                    <i class="fa-solid {{ $breadcrumb['second_item_icon'] }} me-1 text-muted"></i>
                @endif
                <a href="{{ $breadcrumb['second_item_link'] }}" class="text-muted text-hover-primary">
                    {{ $breadcrumb['second_item_name'] }}
                </a>
            </li>
        </ul>
    </div>
</div>
