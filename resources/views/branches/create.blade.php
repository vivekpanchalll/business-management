@extends('layouts.app') 
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Branch</div>

                    <div class="card-body">
                        <form action="{{ route('branches.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="business_id">Select Business:</label>
                                <select name="business_id" id="business_id" class="form-control">
                                    @foreach($businesses as $business)
                                        <option value="{{ $business->id }}">{{ $business->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="name">Branch Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="week_days">Select Weekdays and Time Slots:</label>
                                <div class="row">
                                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                        <div class="col-md-4">
                                            <label>{{ $day }}</label>
                                            <div class="time-slots">
                                                <div class="dateinput mb-2">
                                                    <input type="time" name="week_days[{{ $day }}][][start]" class="form-control" step="300">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">to</span>
                                                    </div>
                                                    <input type="time" name="week_days[{{ $day }}][][end]" class="form-control" step="300">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary add-time-slot">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Branch</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll('.add-time-slot').forEach(function(button) {
                button.addEventListener('click', function() {
                    const timeSlotContainer = button.closest('.time-slots');
                    const newInput = document.createElement('div');
                    newInput.className = 'dateinput mb-2';
                    newInput.innerHTML = `
                        <input type="time" name="${timeSlotContainer.dataset.day}[][][start]" class="form-control" step="300">
                        <div class="input-group-prepend">
                            <span class="input-group-text">to</span>
                        </div>
                        <input type="time" name="${timeSlotContainer.dataset.day}[][][end]" class="form-control" step="300">
                        <div class="append">
                            <button type="button" class="btn btn-outline-secondary remove-time-slot">-</button>
                        </div>`;
                    timeSlotContainer.appendChild(newInput);
                    newInput.querySelector('.remove-time-slot').addEventListener('click', function() {
                        timeSlotContainer.removeChild(newInput);
                    });
                });
            });
        });
    </script>
@endsection
