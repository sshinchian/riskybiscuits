<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
</head>
<body>
    <p>Are you sure you want to delete this item?</p>
    <form method="POST" action="{{ route('workslotbids.destroy', ['workslotbid' => $workslotbid->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</body>
</html>
