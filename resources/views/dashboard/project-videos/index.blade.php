@extends('layouts.vertical', ['subtitle' => 'Project Videos'])

@section('content')

@include('layouts.partials/page-title', ['title' => 'Darkone', 'subtitle' => 'Project Videos'])

<style>
    .table-responsive {
    overflow-x: auto;
    width: 100%;
}

</style>
<div class="card">

    <div class="card-body">
        <a href="{{ route('project-videos.create') }}" class="btn btn-primary float-end">Create Project Videos</a>
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
                edit: "{{ route('project-videos.edit' , ':id') }}",
                delete: "{{ route('project-videos.destroy' , ':id') }}",
            }
        }
    ];
</script>

@vite(['resources/js/pages/table-gridjs.js'])
@endsection
