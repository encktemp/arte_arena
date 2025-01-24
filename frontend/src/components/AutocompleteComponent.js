"use client";

import React, { useState, useEffect } from "react";
import Autocomplete from "@mui/material/Autocomplete";
import TextField from "@mui/material/TextField";
import CircularProgress from "@mui/material/CircularProgress";

export default function AutocompleteComponent() {
  const [options, setOptions] = useState([]);
  const [loading, setLoading] = useState(false);
  const [inputValue, setInputValue] = useState("");

  // Função para buscar itens do backend
  const fetchItems = async (query) => {
    setLoading(true);
    try {
      const response = await fetch(`http://laravel.local/api/app/items?search=${query}`);
      const data = await response.json();
      setOptions(data || []); // Certifique-se de que data é uma array
    } catch (error) {
      console.error("Erro ao buscar itens:", error);
    } finally {
      setLoading(false);
    }
  };

  // Atualiza as opções ao digitar
  useEffect(() => {
    if (inputValue) {
      const delayDebounceFn = setTimeout(() => {
        fetchItems(inputValue);
      }, 300); // Adiciona debounce de 300ms
      return () => clearTimeout(delayDebounceFn);
    }
  }, [inputValue]);

  const handleAddNewItem = async (newItem) => {
    try {
      const response = await fetch("/api/app/items", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ title: newItem }),
      });
      if (response.ok) {
        const newItemData = await response.json();
        setOptions((prev) => [...prev, newItemData]);
      }
    } catch (error) {
      console.error("Erro ao adicionar novo item:", error);
    }
  };

  return (
    <Autocomplete
      options={options}
      getOptionLabel={(option) =>
        typeof option === "string" ? option : option.title
      } // Define qual campo será exibido
      isOptionEqualToValue={(option, value) =>
        option.id === value.id
      } // Garante que o valor selecionado seja único
      loading={loading}
      onInputChange={(event, newInputValue) => {
        setInputValue(newInputValue);
      }}
      renderInput={(params) => (
        <TextField
          {...params}
          label="Buscar ou adicionar"
          variant="outlined"
          InputProps={{
            ...params.InputProps,
            endAdornment: (
              <>
                {loading ? <CircularProgress color="inherit" size={20} /> : null}
                {params.InputProps.endAdornment}
              </>
            ),
          }}
        />
      )}
      freeSolo
      onChange={(event, value) => {
        if (value && typeof value === "string" && !options.some((opt) => opt.title === value)) {
          handleAddNewItem(value); // Adiciona o item ao backend
        }
      }}
    />
  );
}
