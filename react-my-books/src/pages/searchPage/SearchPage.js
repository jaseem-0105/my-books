import React,  { useEffect, useState } from "react";
import { useLocation } from "react-router-dom";
import Navbar from "../../components/layouts/navbar/Navbar";
import Footer from "../../components/layouts/footer/Footer";
import './searchPage.styles.css';
import {baseUrl} from '../../constants/Constants';
import { Axios } from "axios";

const SearchPage = () => {
    const location = useLocation ();
    const [searchValue, setSearchValue] = useState([]);

    useEffect(()=>{
      let searchValue=[];

      console.log(searchValue);
    },[])
    return (
        <section>
            <Navbar darkTheme={true}/>

                <div className="search-result-container">
                    <div className="container">
                        <h2>Your Search Result</h2>
                    </div>

                </div>

            <Footer />
        </section>
    );
};

export default SearchPage;
