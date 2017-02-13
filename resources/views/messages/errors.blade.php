@if(count($errors)>0)
    <h4 class="text-center">Erreurs</h4>
    <ul style="text-align: center; list-style: none; padding: 0;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <hr>
@endif