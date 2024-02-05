import React, { useState } from "react";
import "./searchinputforms.styles.css";
import { useNavigate } from "react-router-dom";

const SearchInputForm = ({ darkTheme }) => {
    const [searchField, setSearchField] = useState("");
    const navigate =useNavigate();

    const handleChange = (e) => {
        setSearchField(e.target.value);

    };
    const redirectToSearch =() =>{
        navigate('/search',{state:searchField})
    }

    return (
        <div
            className={`search-input-container-form ${
                darkTheme ? "dark-box-shadow" : "light-box-shadow"
            }`}
        >
            <input
                type="text"
                className="search-input"
                placeholder="Search Books"
                value={searchField}
                onChange={handleChange}
            />
            <button onClick={redirectToSearch} className="search-button">Search </button>
        </div>
    );
};

export default SearchInputForm;
