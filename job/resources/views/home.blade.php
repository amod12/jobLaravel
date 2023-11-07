@extends  ('layout')

<h1><?php echo $heading;?></h1>

@include('partials._hero')
@include('partials._search')


<?php foreach($items as $item):?> 
<x-item-card :item='$item'/>  
<?php endforeach;?>
@section('content')
@endsection