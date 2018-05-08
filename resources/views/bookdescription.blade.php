<div class="book-description">
    <p>{{ $book->description }}</p>
    <table class="table" style="background-color: #e6e6e6">
        <tr >
            <th class="col-md-2">Tác Giả:</th>
            <td>{{ $book->author }}</td>
        </tr>
        <tr>
            <th class="col-md-2">Thể Loại:</th>
            <td>
                @foreach($book->categories as $cate)
                    <span>{{ $cate->name }}</span>
                @endforeach
            </td>
        </tr>
        <tr>
            <th class="col-md-2">Số Lượng:</th>
            <td>{{ $book->quantity }}</td>
        </tr>
    </table>
</div>