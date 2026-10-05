<x-layouts.app :title="'旅行日記を編集'">
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">旅行日記を編集</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('diaries.update', $diary) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">タイトル</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $diary->title) }}"
                    class="w-full border rounded p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-1">場所</label>
                <input
                    type="text"
                    name="location"
                    value="{{ old('location', $diary->location) }}"
                    class="w-full border rounded p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-1">旅行した日</label>
                <input
                    type="date"
                    name="travel_date"
                    value="{{ old('travel_date', $diary->travel_date) }}"
                    class="w-full border rounded p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-1">日記</label>
                <textarea
                    name="body"
                    rows="6"
                    class="w-full border rounded p-2"
                    required
                >{{ old('body', $diary->body) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block mb-1">写真を変更</label>
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                >
            </div>

            <button
                type="submit"
                style="padding:10px 16px; background:#2563eb; color:white; border:none; border-radius:6px; cursor:pointer;">
                更新する
            </button>

            <a href="{{ route('diaries.show', $diary) }}"
               style="margin-left:10px;">
                戻る
            </a>
        </form>
    </div>
</x-layouts.app>