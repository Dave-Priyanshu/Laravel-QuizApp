<form action="{{route('admin.questions.store')}}" method="POST">
    @csrf
    <div>
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="question_text">Question</label>
        <textarea name="question_text" id="question_text" required></textarea>
    </div>

    <div id="answers-container">
        <div>
            <label for="answer_text">Answer</label>
            <input type="text" name="answers[0][answer_text]" required>
            <label for="is_correct">Correct</label>
            <input type="checkbox" name="answers[0][is_correct]">
        </div>
    </div>
    <button type="submit">Save Question</button>
</form>