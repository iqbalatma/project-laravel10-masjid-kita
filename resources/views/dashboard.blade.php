<x-dashboard.layout>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{$cardTitle}}</h4>
        </div>
        <div class="card-body">
            <div id="chart">
            </div>
        </div>
    </div>
    @push("scripts")
        @vite("resources/js/pages/dashboard/index.js")
    @endpush
</x-dashboard.layout>
