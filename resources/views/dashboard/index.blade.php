@extends('layouts.main_master')

@section('container')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h5>Welcome Back, {{ auth()->user()->name }}</h5>
    </div>
   
    <td class="text-center">
        {{-- @can('publish menu') --}}
        {{-- <form onsubmit="return confirm('Publish post ini?');" action="{{ route('post.publish') }}" method="POST">
        
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-sm btn-success">Publish</button>
        </form> --}}
        
        {{-- @endcan --}}
        
        {{-- @can('unpublish menu') --}}
        {{-- <form onsubmit="return confirm('Unpublish post ini?');" action="{{ route('post.unpublish') }}" method="POST">
        
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-sm btn-success mt-3">Unpublish</button>
        </form> --}}
        
        {{-- @endcan --}}
    
    </td>
@endsection