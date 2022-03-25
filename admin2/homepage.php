<div class="container">
    <div class="home-content">
        <div class="title">Vaccination Centre Details: </div>
        <div class="overview-boxes">
            <div class="box" onclick="location.href='./vc.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">VACCINATION CENTRES</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM vaccination_centres";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bx-cart-alt cart'></i>
            </div>
            <div class="box" onclick="location.href='./vaccineType.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">VACCINE TYPES</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM vaccine_type";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bxs-cart-add cart two' ></i>
            </div>
        </div>
    </div>
    <hr>
    <div class="home-content">
        <div class="title">Laboratory Details:</div>
        <div class="overview-boxes">
            <div class="box" onclick="location.href='./laboratory.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">LABORATORIES</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM laboratories";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bx-cart-alt cart'></i>
            </div>
            <div class="box" onclick="location.href='./testingType.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">TESTING TYPES</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM testing_types";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bxs-cart-add cart two' ></i>
            </div>
        </div>
    </div>
    <hr>
    <div class="home-content">
        <div class="title">Hospital Details:</div>
        <div class="overview-boxes">
            <div class="box" onclick="location.href='./hospital.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">HOSPITALS</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM hospitals";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bx-cart-alt cart'></i>
            </div>
            <div class="box" onclick="location.href='./ward.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">BED TYPES</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM wards";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bxs-cart-add cart two' ></i>
            </div>
        </div>
    </div>
    <hr>
    <div class="home-content">
        <div class="title">Other:</div>
        <div class="overview-boxes">
            <div class="box" onclick="location.href='./state.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">STATE</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM state";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bx-cart-alt cart'></i>
            </div>
            <div class="box" onclick="location.href='./district.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">DISTRICT</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM district";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bxs-cart-add cart two' ></i>
            </div>
            <div class="box" onclick="location.href='./pincode.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">PINCODE</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM pincode";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bx-cart cart three' ></i>
            </div>
        </div>
        <div class="overview-boxes">
            <div class="box" onclick="location.href='./ageGroup.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">AGE GROUP</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM age_group";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bxs-cart-download cart four' ></i>
            </div>
            <div class="box" onclick="location.href='./timeSlot.php';" style="cursor: pointer;">
                <div class="right-side">
                    <div class="box-topic">TIME SLOTS</div>
                    <div class="number">
                        <?php
                            $query = "SELECT * FROM time_slot";
                            if ($result = mysqli_query($connection, $query)) {
                                $rowcount = mysqli_num_rows( $result );
                                echo $rowcount;
                            }
                        ?>
                    </div>
                </div>
                <i class='bx bxs-cart-download cart four' ></i>
            </div>
        </div>
    </div>
    <hr>
</div>