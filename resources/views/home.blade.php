<form action="{{ url('aboutcrud') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="table" value="asd">
    <br>
    <input type="text" name="action" value="save">
    <br>
    <input type="text" name="name" value="asd">
    <br>
    <input type="text" name="age" value="save">
    <br>
    <input type="text" name="address" value="asd">
    <br>
    <input type="text" name="email" value="save">
    <br>
    <input type="text" name="phoneno" value="asd">
    <br>
    <input type="file"  name="image1">
    <br>
    <input type="file"  name="image2">
    <br>
    <input type="file"  name="image3">
    <br>
    <input type="submit" value="done">
</form>