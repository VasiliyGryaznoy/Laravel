<div class="error">
    @if($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif
</div>
<p>List of files:</p>
<ul>
@foreach($files as $file)
        <li><a href="/files/{{$file}}">{{$file}}</a></li>
@endforeach
</ul>