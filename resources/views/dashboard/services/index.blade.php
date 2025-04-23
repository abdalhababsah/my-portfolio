@extends('layouts.vertical', ['subtitle' => 'services'])

@section('content')

@include('layouts.partials/page-title', ['title' => 'Darkone', 'subtitle' => 'services'])

<style>
    .table-responsive {
    overflow-x: auto;
    width: 100%;
}

</style>
<div class="card">

    <div class="card-body">
        <div id="table-projects" style="overflow: auto"></div>

    </div>
</div>



@endsection

@section('scripts')
<script>
    window.gridConfigs = [
        {
            elementId: "table-projects",
            columns: @json($columns),
            data: @json($data)
        }
    ];
</script>
@vite(['resources/js/pages/table-gridjs.js'])
@endsection
