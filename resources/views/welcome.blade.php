<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SMS Portal with Twillio</title>
        
        <!-- Bootstrap style -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        
    </head>
    <body>
        <div>
            <div class="container mt-5">
                <div class="jumbotron">
                    <!-- Show ValidateData answer  -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header text-center fw-bold">
                                    Add Phone Number
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                    @csrf
                                        <div class="form-group">
                                            <label>Enter Phone Number</label>
                                            <input type="tel" class="form-control mt-2" name="phone_number" placeholder="Enter Phone Number">
                                        </div>
                                        <button type="submit" class="mt-4 btn btn-primary">Register User</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header text-center fw-bold">
                                    Send SMS message
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="/custom">
                                    @csrf
                                        <div class="form-group">
                                            <label>Select users to notify</label>
                                            <select name="users[]" multiple class="form-control mt-2">
                                                @foreach ( $users as $user )
                                                <option>{{ $user->phone_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label>Notification Message</label>
                                            <textarea name="body" class="form-control mt-2" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="mt-4 btn btn-primary">Send Notification</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </body>
</html>
