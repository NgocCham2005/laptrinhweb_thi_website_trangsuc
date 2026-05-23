@props([
    'headers' => [],
    'striped' => false,
])

<div class="table-wrapper">
    <table class="table {{ $striped ? 'table-striped' : '' }}">
        @if(count($headers) > 0)
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>