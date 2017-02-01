<div class="error">
    @if($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif
</div>
<p>List of files:</p>
<div>
    @foreach($images as $image)
        <div>
            <p>{{$image}}</p>
            <img src="users-images2/{{$image}}" alt="">
        </div>
    @endforeach
</div>