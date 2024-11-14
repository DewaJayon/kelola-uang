@extends('layouts.dashboard.index')
@section('content')
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Input Kategori
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('home') }}">Dashboard /</a>
                        </li>
                        <li class="font-medium text-primary">Input Kategori</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Form Layout Section Start -->
            <div class="flex flex-col gap-9">
                <!-- Contact Form -->
                <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex items-center justify-between">

                        <a href="{{ route('category.index') }}"
                            class="inline-flex items-center justify-center gap-2.5 rounded-md bg-meta-3 px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                            <span>
                                <svg class="fill-current" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                                </svg>
                            </span>
                            Kembali
                        </a>
                        <h3 class="font-medium text-black dark:text-white">
                            Edit Kategori
                        </h3>
                    </div>

                    <form action="{{ route('category.update', $category->slug) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="p-6.5">

                            <div class="mb-4.5">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Nama <span class="text-meta-1">*</span>
                                </label>
                                <input type="text" placeholder="Masukkan Nama Kategori" name="name" value="{{ old('name', $category->name) }}" required autofocus
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />

                                @error('name')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-s mt-1 ml-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4.5">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Pengeluaran
                                </label>

                                <label class="flex cursor-pointer select-none items-center">
                                    <input type="checkbox" {{ $category->is_expense ? 'checked' : '' }} class="sr-only peer" name="is_expense">
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>

                            <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
                                Edit
                            </button>

                        </div>
                    </form>
                </div>
            </div>

            <!-- ====== Form Layout Section End -->
        </div>
    </main>
@endsection
