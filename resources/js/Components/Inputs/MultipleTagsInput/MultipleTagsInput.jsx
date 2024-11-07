import { React, useState } from 'react';

const MultipleTagsInput = ({...props}) => {
    const [tags, setTags] = useState([]);
    const [inputValue, setInputValue] = useState('');


    const handleKeyDown = (event) => {
        if (event.key === 'Enter' && inputValue.trim()) {
            if (!tags.includes(inputValue.trim())) {
                setTags([...tags, inputValue.trim()]);
            }
            setInputValue(''); // Clear input field
            event.preventDefault(); // Prevent form submission if using Enter
        }
    };


    const handleRemoveTag = (tagToRemove) => {
        setTags(tags.filter(tag => tag !== tagToRemove));
    };
    // console.log(tags);
    
    return (
        <div>
            <div style={styles.tagsContainer}>
                
                <input
                    {...props}
                    style={styles.input}
                    type="text"
                    placeholder="Add a tag and press Enter"
                    value={inputValue}
                    onChange={(e) => setInputValue(e.target.value)}
                    onKeyDown={handleKeyDown}
                />
                {tags.map((tag, index) => (
                    <div key={index} style={styles.tag}>
                        {tag}
                        <span style={styles.removeTag} onClick={() => handleRemoveTag(tag)}>
                            &times;
                        </span>
                    </div>
                ))}
            </div>
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
    },
};

export default MultipleTagsInput;