import React from "react";
import './showcase.styles.css';
import Navbar from "../navbar/Navbar";
import SearchInputForm from "../../forms/searchinputforms/SearchInputForms";

 
const Showcase = () => {
    return (
        <section className="showcase-container">
            <Navbar darkTheme={false}/>
            <div className="overlay"></div>
           <div className="showcase-content">
                <h1>Explore The Beauty Of Reading</h1>
                <p>Buy quality books at cheaper price</p>
                <SearchInputForm  darkTheme={true}/>
           </div>
           
        </section>
    )
}

export default Showcase;   