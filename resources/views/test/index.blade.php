<form action="{{route('webs.subscribe')}}" method="post">
    @csrf
    <input type="number" name="web_id" value="9"><br>
    <input type="number" name="user_id" value="8">
    <button>go</button>
</form>
<form action="{{route('post.create')}}" method="post">
    @csrf
    <input type="number"  name="web_id" value="9"><br>
    <input type="text"  name="title" value="rghtrhytju">
    <input type="text"  name="content" value="sdadasdasdas">
    <button>go</button>
</form>
