
import { reactive, onMounted } from 'vue';

export default function useUrlParams() {
    const params = reactive({});

    const parseUrlParams = () => {
        const queryParams = new URLSearchParams(window.location.search);
        for (const [key, value] of queryParams.entries()) {
            params[key] = value;
        }
    };

    // Function to set URL parameters
    const setUrlParams = (newParams) => {
        const searchParams = new URLSearchParams(window.location.search);
        Object.entries(newParams).forEach(([key, value]) => {
            searchParams.set(key, value);
        });
        window.history.replaceState({}, '', `${window.location.pathname}?${searchParams}`);
        // Parse updated URL parameters
        parseUrlParams();
    };

    // On component mount, parse URL parameters
    onMounted(parseUrlParams);

    return {
        params,
        setUrlParams
    };
}
