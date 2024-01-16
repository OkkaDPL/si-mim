@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ $title }}</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group form-floating-label">
                                <h4>Full name: {{ $i->fname }} {{ $i->lname }}</h4>
                                <br>
                                <h4>Email: {{ $i->email }}</h4>
                                <br>
                                <h4>Phone: {{ $i->tlp }}</h4>
                                <br>
                                <h4>Message: {{ $i->message }}</h4>
                                <br>
                            </div>
                        </div>
                        <div class="card-action">
                            <table>
                                <th><a href="/dashboard/customerprospects" class="btn btn-danger"><span><i
                                                class="fa fa-chevron-left"></i></span> Back</a> </th>
                                @if ($i->status !== 'Responded')
                                    <th>
                                        <form action="/dashboard/customerprospects/{{ $i->id }}/respond"
                                            method="POST">
                                            @method('put')
                                            @csrf
                                            <button class="btn btn-success" type="submit"
                                                onclick="return confirm('Are you sure to response this data?')"><span><i
                                                        class="fa fa-check"></i></span>
                                                Respond</button>
                                        </form>
                                    </th>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
