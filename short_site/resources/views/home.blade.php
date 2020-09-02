@extends("layouts.page")

@section("title", "Home")

@section("body")
<x-widget :page-uid="$page_uid" />
@endsection
