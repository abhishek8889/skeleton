import { useRef ,useState ,useEffect } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import SelectBox from '@/Components/SelectBox';
import FileInput from '@/Components/FileInput';
import { useForm } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import axios from 'axios';

import toastr from 'toastr';
import MultipleTagsInput from '@/Components/Inputs/MultipleTagsInput/MultipleTagsInput';
import NewForm from '@/Components/NewForm';
import TextArea from '@/Components/Inputs/TextArea/TextArea';
// CkEditor
import { CKEditor } from '@ckeditor/ckeditor5-react';
import {
  ClassicEditor,
  Bold,
  Essentials,
  Heading,
  Indent,
  IndentBlock,
  Italic,
  Link,
  List,
  MediaEmbed,
  Paragraph,
  Table,
  Undo,
  CodeBlock,
  SourceEditing
} from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';
import ImageBox from '@/Components/Image/ImageBox';

export default function CreatePost({ className = '' ,categories=[] , postDetail=[] ,thumbnail=[] ,type='' , tags=[] }) {
    const [tagList, setTagList] = useState([]);
    const [metaTags, setMetaTags] = useState([]);
   
    const [pageTile , setPageTitle] = useState((type === 'edit') ? 'Edit Post' : 'Create Post');
    const [submitUrl , setSubmitUrl] = useState((type === 'edit') ? route('posts.update') : route('posts.store'));
    const [submittedButton , setSubmittedButton] = useState((type === 'edit') ? 'Update Post' : 'Create Post');

    const [editorData , setEditorData] = useState({
        content : '',
        excerpt : ''
    });

    const { data, setData, errors, post, reset, processing, recentlySuccessful  } = useForm({
        'id' : (type=='edit') ? postDetail.id : '',
        'title' : (type=='edit') ? postDetail.title : '',
        'short_name' : (type=='edit') ? postDetail.short_name : '',
        'category_id' : (type=='edit') ? postDetail.category_id : '',
        'author' : (type=='edit') ? postDetail.author : '',
        'excerpt' : (type =='edit')?postDetail.excerpt : '',
        'content' : (type =='edit')?postDetail.content :'' ,
        'image' : '',
        'tags' : (type =='edit')?postDetail.tags :tagList,
        'meta_tags' : metaTags || [],
    });


    useEffect(() => {
        if (type === 'edit') {
            setData('meta_tags', postDetail.meta_tags);
            updateMetaTags(postDetail.meta_tags);
            setTagList(
                postDetail.tags.map((tag, index) => (tag.name))
            );
        }

    }, [type ,postDetail]);



    const updateTagList = (newTags) => {
        setTagList(newTags);
        setData('tags', newTags); // Update form data with new tags
    };

    const updateMetaTags = (newTags) => {
        setMetaTags(newTags);
        setData('meta_tags', newTags); // Update form data with new meta tags
    };

    const handleEditorChange = (field) => (event, editor) => {
        const data = editor.getData(); // Retrieve the editor's content
        setEditorData((prev) => ({
            ...prev,
            [field] : data
        }))
        setData(field , data);
    };



    const createPost = (e) => {
        e.preventDefault();

        post(submitUrl, {
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

    // const handleSearchTags = (searchVal) => {
    //     axios.post(route('tags.search'), {
    //         search: searchVal
    //     })
    //     .then(function (response) {
    //         if(response.data.length > 0 && response.status == 200){
    //             setTagModal(response.data);
    //             setTagDialogOpen(true);
    //         }
    //     })
    //     .catch(function (error) {
    //         console.log(error);
    //     });
    // }


    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">{pageTile}</h2>
            </header>

            <form onSubmit={createPost} className="mt-6 space-y-6">
                <div className="row">
                    <div className="col-md-6 mb-3">
                        <InputLabel htmlFor="title" value="Post title" className='mb-2' />
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

                    <div className="col-md-6 mb-3">
                        <InputLabel htmlFor="short_name" value="Short Name" className='mb-2' />
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

                    <div className="col-md-6 mb-3">
                        <InputLabel htmlFor="category_id" value="Category" className='mb-2' />
                        <SelectBox
                            id="category_id"
                            value={data.category_id}
                            onChange={(e) => setData('category_id', e.target.value)}
                            className="mt-1 block w-full"
                            autoComplete="category_id"
                            options={categories}
                        />

                        <InputError message={errors.category_id} className="mt-2" />
                    </div>

                    {/* Author */}

                    <div className="col-md-6 mb-3">
                        <InputLabel htmlFor="author" value="Author" className='mb-2'/>
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

                    <div className="mb-3">
                        <InputLabel htmlFor="excerpt" value="Excerpt"className='mb-2' />

                        <CKEditor
                            editor={ ClassicEditor }
                            config={ {
                                toolbar: [
                                'undo', 'redo', '|',
                                'heading', '|', 'bold', 'italic', '|',
                                'link', 'insertTable', 'mediaEmbed', '|',
                                'bulletedList', 'numberedList', 'indent', 'outdent' ,'codeBlock','sourceEditing'
                                ],
                                plugins: [
                                Bold,
                                Essentials,
                                Heading,
                                Indent,
                                IndentBlock,
                                Italic,
                                Link,
                                List,
                                MediaEmbed,
                                Paragraph,
                                Table,
                                Undo,
                                CodeBlock,
                                SourceEditing
                                ],
                            } }

                            id="excerpt"
                            data={type === 'edit' ? postDetail.excerpt : editorData.excerpt}
                            onChange={(handleEditorChange('excerpt'))}
                        />
                        <InputError message={errors.excerpt} className="mt-2" />
                    </div>

                    <div className="mb-3">
                        <InputLabel htmlFor="content" value="Content" className='mb-2'/>

                        <CKEditor
                            editor={ ClassicEditor }
                            config={ {
                                toolbar: [
                                'undo', 'redo', '|',
                                'heading', '|', 'bold', 'italic', '|',
                                'link', 'insertTable', 'mediaEmbed', '|',
                                'bulletedList', 'numberedList', 'indent', 'outdent' ,'codeBlock','sourceEditing'
                                ],
                                plugins: [Bold,Essentials,Heading,Indent,IndentBlock,Italic,Link,List,MediaEmbed,Paragraph,Table,Undo,CodeBlock,SourceEditing],
                            } }

                            id="content"
                            data={type === 'edit' ? postDetail.content : editorData.content}
                            onChange={(handleEditorChange('content'))}
                        />

                        <InputError message={errors.content} className="mt-2" />
                    </div>

                    <div className="mb-3">
                        <InputLabel htmlFor="tags" value="Add Tags" className='mb-2'/>
                        <MultipleTagsInput 
                            id="tags"  
                            enableSearch={true}
                            searchParam={
                                {
                                    route:route('tags.search')
                                }
                            } 
                            tagList={tagList} 
                            updateTagList={updateTagList} 
                        />
                    </div>

                    <div className="mb-3">
                        <InputLabel htmlFor="meta_tags" value="Add Meta Tags" className='mb-2'/>
                        <MultipleTagsInput id="meta_tags" tagList={metaTags} updateTagList={updateMetaTags}  />
                    </div>

                   

                    <div className="mb-3">
                        <InputLabel htmlFor="image" value="Image" className='mb-2'/>
                        <FileInput
                            id="image"
                            type="file"
                            onChange={(e) => setData('image', e.target.files[0])}
                            className="mt-1 block  mb-2"
                        />
                        { type == 'edit' &&
                            <ImageBox src={thumbnail.url} boxClass="h-25 w-25" imgClass="img-thumbnail rounded" ></ImageBox>         
                        }
                        <InputError message={errors.image} className="mt-2" />
                    </div>

                    <div className="flex items-center gap-4">
                        <PrimaryButton disabled={processing}>{submittedButton}</PrimaryButton>
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
                </div>
            </form>
        </section>
    );
}
