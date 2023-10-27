<form action="/importFaking" method="POST">
    @csrf 
    <input type="file" name="csv">
    <button type="submit">Submit</button>
</form>