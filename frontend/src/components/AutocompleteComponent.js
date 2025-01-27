"use client";

import React, { useState, useEffect } from "react";
import Autocomplete from "@mui/material/Autocomplete";
import TextField from "@mui/material/TextField";
import CircularProgress from "@mui/material/CircularProgress";
import SearchIcon from "@mui/icons-material/Search";
import InputAdornment from "@mui/material/InputAdornment";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import IconButton from "@mui/material/IconButton";
import CloseIcon from "@mui/icons-material/Close";

export default function AutocompleteComponent() {
  const [options, setOptions] = useState([]);
  const [loading, setLoading] = useState(false);
  const [inputValue, setInputValue] = useState("");
  const [addedPosts, setAddedPosts] = useState([]);

  useEffect(() => {
    const storedPosts = localStorage.getItem("addedPosts");
    if (storedPosts) {
      setAddedPosts(JSON.parse(storedPosts));
    }
  }, []);

  useEffect(() => {
    localStorage.setItem("addedPosts", JSON.stringify(addedPosts));
  }, [addedPosts]);

  const fetchItems = async (query) => {
    setLoading(true);
    try {
      const response = await fetch(
        `http://laravel.local/api/app/items?search=${query}`
      );
      const data = await response.json();
      setOptions(data || []);
    } catch (error) {
      console.error("Erro ao buscar itens:", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    if (inputValue) {
      const delayDebounceFn = setTimeout(() => {
        fetchItems(inputValue);
      }, 300);
      return () => clearTimeout(delayDebounceFn);
    }
  }, [inputValue]);

  const handleAddPost = (post) => {
    if (!addedPosts.some((addedPost) => addedPost.id === post.id)) {
      setAddedPosts((prev) => [...prev, post]);
    }
    setInputValue("");
    setOptions([]);
  };

  const handleRemovePost = (id) => {
    setAddedPosts((prev) => prev.filter((post) => post.id !== id));
  };

  const handleFocus = () => {
    document.body.classList.add("blur-effect");
  };

  const handleBlur = () => {
    setTimeout(() => {
      document.body.classList.remove("blur-effect");
    }, 200);
  };

  return (
    <div>
      <Autocomplete
        options={options}
        getOptionLabel={(option) =>
          typeof option === "string" ? option : option.title
        }
        isOptionEqualToValue={(option, value) => option.id === value.id}
        loading={loading}
        inputValue={inputValue}
        onInputChange={(event, newInputValue) => {
          setInputValue(newInputValue);
        }}
        onChange={(event, value) => {
          if (value && typeof value !== "string") {
            handleAddPost(value);
            setInputValue("");
          }
        }}
        renderInput={(params) => (
          <TextField
            {...params}
            label="Buscar ou adicionar"
            variant="outlined"
            onFocus={handleFocus} // Aplica o blur
            onBlur={handleBlur} // Remove o blur
            sx={{
              "& .MuiInputLabel-root": {
                color: "#FE642E",
              },
              "& .MuiOutlinedInput-root": {
                color: "white",
                "& fieldset": {
                  borderColor: "#848484",
                },
                "&:hover fieldset": {
                  borderColor: "#ffffff",
                },
                "&.Mui-focused fieldset": {
                  borderColor: "#FE642E",
                },
              },
            }}
            InputProps={{
              ...params.InputProps,
              endAdornment: (
                <>
                  <InputAdornment position="end">
                    <SearchIcon style={{ color: "white" }} />
                  </InputAdornment>
                  {loading ? (
                    <CircularProgress color="inherit" size={20} />
                  ) : null}
                  {params.InputProps.endAdornment}
                </>
              ),
            }}
          />
        )}
        freeSolo
        sx={{
          "& .MuiAutocomplete-listbox": {
            backgroundColor: "#333",
            color: "white",
            "& .MuiAutocomplete-option": {
              backgroundColor: "#333",
              color: "white",
              "&:hover": {
                backgroundColor: "#0040FF",
                color: "white",
              },
            },
          },
        }}
      />

      <Box sx={{ mt: 3 }}>
        {addedPosts.map((post, index) => (
          <Box
            key={post.id}
            sx={{
              display: "flex",
              flexDirection: "column",
              backgroundColor: "#333",
              color: "white",
              padding: 2,
              borderRadius: 2,
              marginBottom: 2,
              position: "relative",
            }}
          >
            <Typography variant="body1" sx={{ textAlign: "left" }}>
              {`${index + 1}. `}
              <span style={{ color: "#FE642E", fontWeight: "bold" }}>Título:</span>{" "}
              {post.title}
            </Typography>
            <Typography variant="body2" sx={{ textAlign: "left", mt: 1 }}>
              <span style={{ color: "#FE642E", fontWeight: "bold" }}>
                Descrição:
              </span>{" "}
              {post.body}
            </Typography>
            <IconButton
              onClick={() => handleRemovePost(post.id)}
              sx={{
                position: "absolute",
                top: 8,
                right: 8,
                color: "white",
              }}
            >
              <CloseIcon />
            </IconButton>
          </Box>
        ))}
      </Box>
    </div>
  );
}
