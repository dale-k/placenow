
@extends('layouts.master')

@section('title','Place Now - welcome')

@section('content')

@foreach ($email_list as $i)
	{{$i->email}}
@endforeach

@endsection