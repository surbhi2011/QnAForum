<!DOCTYPE html>

<html>

<head>

        <title></title>

</head>

<body>

<form method="POST" action="/askquestion">
    @csrf
    <div class="form-group">
        <label for="Title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Question">
    </div>
    <div class="form-group">
        <label for="Description">Description</label>
        <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>





</body>

</html>


