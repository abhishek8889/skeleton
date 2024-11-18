import { useRef ,useState } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import SelectBox from '@/Components/SelectBox';
import FileInput from '@/Components/FileInput';
import { useForm } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

import toastr from 'toastr';
import MultipleTagsInput from '@/Components/Inputs/MultipleTagsInput/MultipleTagsInput';
import NewForm from '@/Components/NewForm';
import TextArea from '@/Components/Inputs/TextArea/TextArea';
// import NewForm from '@/Components/NewForm';
export default function CreatePost({ className = '' ,categories=[] }) {
    const [tagList, setTagList] = useState([]);
    const [metaTags, setMetaTags] = useState([]);

    const { data, setData, errors, post, reset, processing, recentlySuccessful } = useForm({
        'title' : '',
        'short_name' : '',
        'category_id' : '',
        'author' : '',
        'excerpt' : '',
        'content' : '',
        'image' : '',
        'tags' : tagList || [],
        'meta_tags' : metaTags || [],
    });


    const updateTagList = (newTags) => {
        setTagList(newTags);
        setData('tags', newTags); // Update form data with new tags
    };

    const updateMetaTags = (newTags) => {
        setMetaTags(newTags);
        setData('meta_tags', newTags); // Update form data with new meta tags
    };
    // console.log(`Tag list => ${tagList}`);

    const createPost = (e) => {
        e.preventDefault();

        post(route('posts.store'), {
            preserveScroll: true,
            onSuccess: (response) => {

                reset();
            },
            onError: (errors) => {
                // if (errors.password) {
                //     reset('password', 'password_confirmation');
                //     passwordInput.current.focus();
                // }

                // if (errors.current_password) {
                //     reset('current_password');
                //     currentPasswordInput.current.focus();
                // }
            },
        });
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Add Post</h2>
            </header>

            <form onSubmit={createPost} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="title" value="Post title" />
                    <TextInput
                        id="title"
                        value={data.title}
                        onChange={(e) => setData('title', e.target.value)}
                        type="text"
                        className="mt-1 block w-full"
                        autoComplete="title"
                    />
                    <InputError message={errors.title} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="short_name" value="Short Name" />
                    <TextInput
                        id="short_name"
                        value={data.short_name}
                        onChange={(e) => setData('short_name', e.target.value)}
                        type="text"
                        className="mt-1 block w-full"
                        autoComplete="short_name"
                    />
                    <InputError message={errors.short_name} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="category_id" value="Category" />
                    <SelectBox
                        id="category_id"
                        value={data.categories}
                        onChange={(e) => setData('category_id', e.target.value)}
                        className="mt-1 block w-full"
                        autoComplete="category_id"
                        options={categories}
                    />
                    <InputError message={errors.category_id} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="excerpt" value="Excerpt" />
                    <TextArea
                        id="excerpt"
                        rows={3}
                        value={data.excerpt}
                        onChange={(e) => setData('excerpt', e.target.value)}
                        className=""
                        autoComplete="excerpt"
                    />
                    <InputError message={errors.excerpt} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="content" value="Content" />
                    <TextArea
                        id="content"
                        rows={3}
                        value={data.content}
                        onChange={(e) => setData('content', e.target.value)}
                        className=""
                        autoComplete="content"
                    />

                    <InputError message={errors.content} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="tags" value="Add Tags" />
                    <MultipleTagsInput id="tags" tagList={tagList} updateTagList={updateTagList}  />
                </div>

                <div>
                    <InputLabel htmlFor="meta_tags" value="Add Meta Tags" />
                    <MultipleTagsInput id="meta_tags" tagList={metaTags} updateTagList={updateMetaTags}  />
                </div>

                <div>
                    <InputLabel htmlFor="author" value="Author" />
                    <TextInput
                        id="author"
                        value={data.author}
                        onChange={(e) => setData('author', e.target.value)}
                        type="text"
                        className="mt-1 block w-full"
                        autoComplete="author"
                    />
                    <InputError message={errors.author} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="image" value="Image" />
                    <FileInput
                        id="image"
                        type="file"
                        onChange={(e) => setData('image', e.target.files[0])}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.image} className="mt-2" />
                </div>




                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>
                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
