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

document.addEventListener('change', (event) => {
    const input = event.target;

    if (!(input instanceof HTMLInputElement) || input.type !== 'file' || input.id !== 'temporary_images') {
        return;
    }

    const fileName = input.closest('.image-upload-control')?.querySelector('[data-file-name]');

    if (fileName) {
        fileName.textContent = Array.from(input.files ?? [], (file) => file.name).join(', ')
            || fileName.dataset.emptyLabel
            || '';
    }
});

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
const categoryScrollControls = document.querySelectorAll('[data-category-scroll]');

if (categoryContainer) {
    const leftScrollControl = document.querySelector('[data-category-scroll="left"]');
    const rightScrollControl = document.querySelector('[data-category-scroll="right"]');

    const updateCategoryScrollControls = () => {
        const maxScrollLeft = categoryContainer.scrollWidth - categoryContainer.clientWidth;
        const canScroll = maxScrollLeft > 1;
        const hasScrolledLeft = categoryContainer.scrollLeft > 1;

        categoryContainer.classList.toggle('has-left-scroll', canScroll && hasScrolledLeft);

        if (leftScrollControl) {
            leftScrollControl.hidden = !canScroll || !hasScrolledLeft;
        }

        if (rightScrollControl) {
            rightScrollControl.hidden = !canScroll || categoryContainer.scrollLeft >= maxScrollLeft - 1;
        }
    };

    categoryScrollControls.forEach((control) => {
        control.addEventListener('click', () => {
            const direction = control.dataset.categoryScroll === 'right' ? 1 : -1;

            categoryContainer.scrollBy({
                left: direction * categoryContainer.clientWidth * 0.75,
                behavior: 'smooth',
            });
        });
    });

    categoryContainer.addEventListener('scroll', updateCategoryScrollControls, { passive: true });
    window.addEventListener('resize', updateCategoryScrollControls);

    const activeCategoryLink = categoryContainer.querySelector('a.is-active');

    if (activeCategoryLink && window.matchMedia('(max-width: 767.98px)').matches) {
        const targetScrollLeft = activeCategoryLink.offsetLeft
            + activeCategoryLink.offsetWidth / 2
            - categoryContainer.clientWidth / 2;

        categoryContainer.scrollLeft = Math.max(
            0,
            Math.min(targetScrollLeft, categoryContainer.scrollWidth - categoryContainer.clientWidth)
        );
    }

    updateCategoryScrollControls();
}

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
