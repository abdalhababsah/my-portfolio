@extends('layouts.vertical', ['subtitle' => 'Social Links'])

@section('content')

@include('layouts.partials.page-title', ['title' => 'Darkone', 'subtitle' => 'Social Links'])

<style>
    .table-responsive {
    overflow-x: auto;
    width: 100%;
}

</style>
<div class="card">

    <div class="card-body">
        <a href="{{ route('social-links.create') }}" class="btn btn-primary float-end">Create Social Links</a>
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
                edit: "{{ route('social-links.edit' , ':id') }}",
                delete: "{{ route('social-links.destroy' , ':id') }}",
            }
        }
    ];
</script>

@vite(['resources/js/pages/table-gridjs.js'])
@endsection
