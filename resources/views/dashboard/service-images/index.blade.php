@extends('layouts.vertical', ['subtitle' => 'Service Images'])

@section('content')

@include('layouts.partials.page-title', ['title' => 'Darkone', 'subtitle' => 'Service Images'])

<style>
    .table-responsive {
    overflow-x: auto;
    width: 100%;
}

</style>
<div class="card">

    <div class="card-body">
        <a href="{{ route('service-images.create') }}" class="btn btn-primary float-end">Create Service Images</a>
        <div id="table-projects" style="overflow: auto"></div>

    </div>
</div>



@endsection

@section('scripts')
<script>
    window.csrfToken = "{{ csrf_token() }}";

    window.gridConfigs = [
        {
            elementId: "table-projects",
            columns: @json($columns),
            data: @json($data),
            routes: {
                edit: "{{ route('service-images.edit' , ':id') }}",
                delete: "{{ route('service-images.destroy' , ':id') }}",
            }
        }
    ];
</script>

@vite(['resources/js/pages/table-gridjs.js'])
@endsection
