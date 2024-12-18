import { React, useEffect, useState } from 'react';

const MultipleTagsInput = ({tagList, updateTagList,searchParam,enableSearch=false ,...props }) => {

    const [tags, setTags] = useState([]);
    const [inputValue, setInputValue] = useState('');

    const [tagDialogList,setTagDialogList] = useState([]);
    const [isTagDialogOpen, setTagDialogOpen] = useState(false); // Control dialog visibility



    useEffect(() => {
        if (tagList && tagList.length > 0) {
            setTags(tagList);
        }
    }, [tagList]);

    useEffect(() => {
        if(isTagDialogOpen == true){

        }
    }, [tagDialogList,isTagDialogOpen]); 

    const handleSearchTags = (searchVal) => {
        setTagDialogList([]);
        setTagDialogOpen(false);    
        if(searchVal != '' && searchVal != undefined ){
            axios.post(searchParam.route, {
                search: searchVal
            })
            .then(function (response) {
                if(response.data.data.length > 0 && response.data.success == true){
                    setTagDialogList(response.data.data);
                    setTagDialogOpen(true);
                }else{
                    setTagDialogList([]);
                    setTagDialogOpen(false);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }


    const handleKeyDown = (event) => {
        if (event.key === 'Enter' && inputValue.trim()) {
            const newTag = inputValue.trim();
            if (!tags.includes(newTag)) {
                const updatedTags = [...tags, newTag ];
                setTags(updatedTags);
                updateTagList(updatedTags); // Send updated tags to parent
            }
            setInputValue(''); // Clear input field
            event.preventDefault(); // Prevent form submission if using Enter
        }
    };

    const handleAddTag = (tag) => {
        const updatedTags = [...tags, tag.name ];
        setTags(updatedTags);
        updateTagList(updatedTags); 
        setTagDialogList([]); // Clear the list
        setTagDialogOpen(false); // Close the dialog
        setInputValue('');
    }


    const handleRemoveTag = (tagToRemove) => {
        const updatedTags = tags.filter(tag => tag !== tagToRemove);
        setTags(updatedTags);
        updateTagList(updatedTags);
    };
    
    return (
        <div>
            <div style={styles.tagsContainer}>
                
                <input
                    {...props}
                    style={styles.input}
                    type="text"
                    placeholder="Add a tag and press Enter"
                    value={inputValue}
                    onChange={(e) => {
                        setInputValue(e.target.value);
                        if(enableSearch == true){
                            handleSearchTags(e.target.value);
                        }
                    }}
                    onKeyDown={handleKeyDown}
                />

                {/* {
                    console.log(tags)
                } */}
                {tags.map((tag, index) => (
                    <div key={index} style={styles.tag}>
                        {tag}
                        <span style={styles.removeTag} onClick={() => handleRemoveTag(tag)}>
                            &times;
                        </span>
                    </div>
                ))}
            </div>

            {isTagDialogOpen && (
                <div className="dialog-overlay">
                    <div className="dialog-box">
                        <h5>Select a Tag</h5>
                        {tagDialogList.map((tag) => (
                            <div
                                key={tag.id}
                                className="tag-item"
                                onClick={() => handleAddTag(tag)} // Add tag on click
                                style={{ cursor: "pointer", padding: '5px 10px', borderRadius: '5px', margin: '5px',border:'1px solid #ccc',hover:'#342121'}}
                            >
                            {tag.name}
                            </div>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
}

const styles = {
    tagsContainer: {
        display: 'flex',
        alignItems: 'center',
        flexWrap: 'wrap',
        padding: '8px',
        border: '1px solid #ccc',
        borderRadius: '4px',
    },
    tag: {
        display: 'flex',
        alignItems: 'center',
        padding: '4px 8px',
        margin: '4px',
        backgroundColor: '#007bff',
        color: 'white',
        borderRadius: '4px',
    },
    removeTag: {
        marginLeft: '8px',
        cursor: 'pointer',
        color: '#fff',
        fontWeight: 'bold',
    },
    input: {
        border: 'none',
        outline: 'none',
        padding: '8px',
        fontSize: '14px',
    }    
};

export default MultipleTagsInput;