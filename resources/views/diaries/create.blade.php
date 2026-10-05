<x-layouts.app :title="'旅行日記を投稿'">
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">旅行日記を書く</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('diaries.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">タイトル</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="w-full border rounded p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-1">場所</label>
                <input
                    type="text"
                    name="location"
                    value="{{ old('location') }}"
                    class="w-full border rounded p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-1">旅行した日</label>
                <input
                    type="date"
                    name="travel_date"
                    value="{{ old('travel_date') }}"
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
                >{{ old('body') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block mb-1">写真</label>
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full"
                >
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    style="padding:10px 16px; background:#2563eb; color:white; border:none; border-radius:6px; cursor:pointer;">
                    投稿する
                </button>

                <a href="{{ route('diaries.index') }}"
                   class="px-4 py-2 border rounded">
                    戻る
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>