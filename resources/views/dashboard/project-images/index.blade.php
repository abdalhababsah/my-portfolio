@extends('layouts.vertical', ['subtitle' => 'Project Images'])

@section('content')

@include('layouts.partials/page-title', ['title' => 'Darkone', 'subtitle' => 'Project Images'])

<style>
    .table-responsive {
    overflow-x: auto;
    width: 100%;
}

</style>
<div class="card">

    <div class="card-body">
        <a href="{{ route('project-images.create') }}" class="btn btn-primary float-end">Create Project Images</a>
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
                edit: "{{ route('project-images.edit' , ':id') }}",
                delete: "{{ route('project-images.destroy' , ':id') }}",
            }
        }
    ];
</script>

@vite(['resources/js/pages/table-gridjs.js'])
@endsection
