@if(count($errors)>0)
            <div class="alert alert-danger">
            <!-- $errors是个对象，要查出来 -->
                @foreach($errors->all() as $error)  
                <li>{{$error}}</li>
                @endforeach
            </div>
@endif