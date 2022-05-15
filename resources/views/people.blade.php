<x-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="mb-5 mt-5">
                        People dashboard
                    </h1>

                    {{-- data filters --}}
                    <form method="GET">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="birth-year">Birth year</label>
                                <input class="form-control" id="birth-year" name="birth-year" type="number" value="{{ request('birth-year') }}">
                            </div>
                            <div class="col">
                                <label class="form-label" for="birth-month">Birth month</label>
                                <input class="form-control" id="birth-month" name="birth-month" type="number" value="{{ request('birth-month') }}">
                            </div>
                            <div class="col align-self-end">
                                <input type="submit" class="btn btn-primary" value="Filter">
                            </div>
                        </div>
                    </form>

                    {{-- top pagination --}}
                    <x-pagination :people="$people" />

                    {{-- dashboard table --}}
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Birth Day</th>
                                <th>Phone</th>
                                <th>IP</th>
                                <th>Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($people as $person)
                            <tr>
                                <td>{{ $person->id }}</td>
                                <td>{{ $person->email }}</td>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->dob }}</td>
                                <td>{{ $person->phone }}</td>
                                <td>{{ $person->ip }}</td>
                                <td>{{ $person->country }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- bottom pagination --}}
                    <x-pagination :people="$people" />
                </div>
            </div>
        </div>
    </x-slot>
</x-layout>
