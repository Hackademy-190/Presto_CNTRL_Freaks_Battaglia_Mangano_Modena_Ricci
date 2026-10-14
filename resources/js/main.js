const navbar = document.querySelector('.navbar-cus');
const navbarCollapse = navbar?.querySelector('.navbar-collapse');
let isNavbarCollapseOpen = navbarCollapse?.classList.contains('show') ?? false;

const updateNavbarBackground = () => {
    if (window.scrollY > 0 || isNavbarCollapseOpen) {
        navbar?.classList.add('scrollNav');
    } else {
        navbar?.classList.remove('scrollNav');
    }
};

navbarCollapse?.addEventListener('show.bs.collapse', () => {
    isNavbarCollapseOpen = true;
    updateNavbarBackground();
});

navbarCollapse?.addEventListener('hidden.bs.collapse', () => {
    isNavbarCollapseOpen = false;
    updateNavbarBackground();
});

window.addEventListener('scroll', updateNavbarBackground);
updateNavbarBackground();

const searchInput = navbar?.querySelector('#query');
const searchClearButton = navbar?.querySelector('.search-clear');

if (searchInput && searchClearButton) {
    const updateSearchClearButton = () => {
        searchClearButton.hidden = searchInput.value.length === 0;
    };

    searchInput.addEventListener('input', updateSearchClearButton);
    searchClearButton.addEventListener('click', () => {
        searchInput.value = '';
        searchInput.focus();
        updateSearchClearButton();
    });

    updateSearchClearButton();
}

const categoryContainer = document.querySelector('.container-category');
const categoryOutline = categoryContainer?.querySelector('.outline');
const categoryOutlineRect = categoryOutline?.querySelector('.rect');
const categoryButtons = categoryContainer?.querySelectorAll('.btn-category') ?? [];

if (categoryContainer && categoryOutline && categoryOutlineRect) {
    let activeCategoryButton = null;

    const resizeCategoryOutline = () => {
        const outlineBounds = categoryOutline.getBoundingClientRect();

        categoryOutline.setAttribute('viewBox', `0 0 ${outlineBounds.width} ${outlineBounds.height}`);
        categoryOutlineRect.setAttribute('width', outlineBounds.width);
        categoryOutlineRect.setAttribute('height', outlineBounds.height);
    };

    const updateCategoryOutline = (categoryButton) => {
        resizeCategoryOutline();

        const outlineBounds = categoryOutline.getBoundingClientRect();
        const buttonBounds = categoryButton.getBoundingClientRect();
        const unitsPerPixel = 100 / (2 * (outlineBounds.width + outlineBounds.height));
        const dashStart = (buttonBounds.left - outlineBounds.left) * unitsPerPixel;
        const dashLength = buttonBounds.width * unitsPerPixel;
        const rightGap = (outlineBounds.right - buttonBounds.right) * unitsPerPixel;
        const verticalGap = outlineBounds.height * unitsPerPixel;
        const dashBetweenSegments = 2 * rightGap + verticalGap;
        const dashRemainder = 2 * dashStart + verticalGap;

        categoryOutlineRect.style.strokeDasharray = `0 ${dashStart} ${dashLength} ${dashBetweenSegments} ${dashLength} ${dashRemainder}`;
        categoryOutlineRect.style.strokeDashoffset = '0';
    };

    categoryButtons.forEach((categoryButton) => {
        categoryButton.addEventListener('pointerenter', () => {
            activeCategoryButton = categoryButton;
            updateCategoryOutline(categoryButton);
        });
    });

    categoryContainer.addEventListener('pointerleave', () => {
        activeCategoryButton = null;
        categoryOutlineRect.style.removeProperty('stroke-dasharray');
        categoryOutlineRect.style.removeProperty('stroke-dashoffset');
    });

    window.addEventListener('resize', () => {
        if (activeCategoryButton) {
            updateCategoryOutline(activeCategoryButton);
        } else {
            resizeCategoryOutline();
        }
    });

    resizeCategoryOutline();
}
