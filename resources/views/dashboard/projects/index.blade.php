@extends('layouts.vertical', ['subtitle' => 'projects'])

@section('content')

@include('layouts.partials.page-title', ['title' => 'Darkone', 'subtitle' => 'projects'])

<style>
    .table-responsive {
    overflow-x: auto;
    width: 100%;
}

</style>
<div class="card">

    <div class="card-body">
        <a href="{{ route('admin.project.create') }}" class="btn btn-primary float-end">Create Project</a>
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
                edit: "{{ url('admin/project/edit') }}/:id",
                // delete: "{{ url('project/delete') }}/:id",
            }
        }
    ];
</script>

@vite(['resources/js/pages/table-gridjs.js'])
@endsection
